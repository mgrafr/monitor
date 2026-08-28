import platform
import subprocess
import time
import json
import paho.mqtt.client as mqtt
import connect as m
import random
import mysql.connector
# ---------------------------
# CONFIGURATION
# ---------------------------
BROKER = m.ip_mqtt # Adresse du broker MQTT
PORT =  m.port_mqtt       # Port MQTT
TOPIC = "z1m/pingpi"           # Sujet MQTT
CLIENT_ID = f"python_client_{random.randint(1000, 9999)}"    # ID client MQTT
USERNAME = m.user_mqtt            # Si authentification : "user"
PASSWORD = m.mot_passe_mqtt       # Si authentification : "pass"
connection_params = m.connection_db
IPS = ["192.168.1.91","192.168.1.140"]  # Liste des IP à surveiller
PING_INTERVAL = 180  # secondes entre chaque ping

# ---------------------------
# FONCTIONS
# ---------------------------

def ping_host(host):
    """
    Retourne True si le ping réussit, False sinon.
    Compatible Windows / Linux / macOS.
    """
    param = "-n" if platform.system().lower() == "windows" else "-c"
    try:
        result = subprocess.run(
            ["ping", param, "1", host],
            stdout=subprocess.DEVNULL,
            stderr=subprocess.DEVNULL
        )
        return result.returncode == 0
    except Exception as e:
        print(f"[ERREUR] Ping vers {host} impossible : {e}")
        return False

def on_connect(client, userdata, flags, reason_code, properties):
    if reason_code == 0:
        print("[MQTT] Connecté au broker.")
    else:
        print(f"[MQTT] Erreur de connexion : {reason_code}")

def mqtt_publish(client, topic, payload):
    try:
        client.publish(topic, payload, qos=0, retain=False)
        print(f"[MQTT] Publié sur {topic} : {payload}")
    except Exception as e:
        print(f"[ERREUR MQTT] {e}")

# ---------------------------
# PROGRAMME PRINCIPAL
# ---------------------------
if __name__ == "__main__":
    # Connexion MQTT
    client = mqtt.Client(mqtt.CallbackAPIVersion.VERSION2)
    if USERNAME and PASSWORD:
        client.username_pw_set(USERNAME, PASSWORD)
    client.on_connect = on_connect

    try:
        client.connect(BROKER, PORT, keepalive=60)
    except Exception as e:
        print(f"[ERREUR] Impossible de se connecter au broker MQTT : {e}")
        exit(1)

    client.loop_start()

    try:
        while True:
            for ip in IPS:
                status = ping_host(ip)
                if status : 
                    val="online"
                else : 
                    val="offline"
                payload = json.dumps({
                    "id": ip,
                    "objet": "",
                    "state": val,
                    "champ1": "Ping",
                    "champ2": time.strftime("%Y-%m-%d %H:%M:%S"),
                    "idm": m.proxmox_media[1]
                })
                              
                with mysql.connector.connect(**connection_params) as db :
                    with db.cursor() as c:
                        request = "UPDATE dispositifs SET param = '"+val+"'WHERE idm ='"+m.proxmox_media[1]+"'"
                        c.execute(request)
                        db.commit()
            
                mqtt_publish(client, TOPIC, payload)
                with open("/www/monitor/ping.log", "a", encoding="utf-8") as file:
                    file.write(payload+"  "+time.strftime("%Y-%m-%d %H:%M:%S")+"\n")
            time.sleep(PING_INTERVAL)
    except KeyboardInterrupt:
        print("\n[STOP] Arrêt du script.")
    finally:
        client.loop_stop()
        client.disconnect()