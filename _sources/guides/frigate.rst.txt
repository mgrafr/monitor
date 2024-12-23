22. FRIGATE
-----------
22.1 Matériel
^^^^^^^^^^^^^
-**1 mini PC**  ou plutôt micro compte tenu de sa taille *raccordé au routeur par un cable ethernet*

|image1595| 

|image1597| 

Processeur d'image (GPU):Carte graphique Intel ® Supercore (jusqu'à 750MHz)

Mémoire en cours d'exécution (RAM):LPDDR5 4800 MT/s, montage à bord,

Disque dur de stockage:Compatible M.2 2242 SATA, SATA/PCIE

Construit dans l'expansion de stockage:M.2 2242 peut évoluer à 2 To;

Sortie graphique:Double sortie HDMI + DP V1.4, prenant en charge une résolution maximale de 4096x2160

Réseau sans fil:Realtek 8852BE 802.11a/b/g/n/ac/ax

Interface de puissance:Interface TYPE-C, 12V/3A, 36W (charge uniquement) Prise en charge de l'alimentation PD

USB-A:USB3.2 (Gen1 * 1) * 3

Sortie vidéo:HDMI * 2 4096x2160 @ 60Hz , DP V1.4 * 1 4096x2160 @ 60Hz

Interface audio:Å3.5mm, CTIA

Port Ethernet:GLA Lan (RJ45) * 2 1000m/100m/10m

Indicateur de lumière:Indicateur de puissance bleu clair

Taille du corps:87*87*39.5MM

Poids corporel:397 grammes

Système d'exploitation:Windows 11 Pro Édition Professionnelle

22.1.1 Installation du module Pcie Coral
========================================

|image1596| 

Comme il n'y a qu'un seul emplacement Pcie occupé par une carte wifi-BT et comme le PC est raccordé par un cable ethernet:

- on remplace le module wifi (qui se trouve sous la carte M2) par le module Coral

|image1598| 

Le couvercle est clipsé, pour l'ouvrir il suffit de déclipser en soulevant avec un tournevis

22.2 Installation docker
========================
- **Ajouter la clé GPG officielle de Docker:**

.. code-block::

   sudo apt-get update
   sudo apt-get install ca-certificates curl
   sudo install -m 0755 -d /etc/apt/keyrings
   sudo curl -fsSL https://download.docker.com/linux/debian/gpg -o /etc/apt/keyrings/docker.asc
   sudo chmod a+r /etc/apt/keyrings/docker.asc

- **Ajoutez le dépôt aux sources Apt :**

.. code-block::

   echo \
  "deb [arch=$(dpkg --print-architecture) signed-by=/etc/apt/keyrings/docker.asc] https://download.docker.com/linux/debian \
  $(. /etc/os-release && echo "$VERSION_CODENAME") stable" | \
  sudo tee /etc/apt/sources.list.d/docker.list > /dev/null
  sudo apt-get update

- **Installez les packages Docker:**

.. code-block::

   sudo apt-get install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin

- **1.	Vérifiez que l’installation a réussi en exécutant l’image :hello-world**

.. code-block::

   sudo docker run hello-world

|image1599|

- **créer le groupe docker et ajouter-vous comme utilisateur :**

.. code-block::

   sudo groupadd docker
   sudo usermod -aG docker $USER

- **Configurer Docker pour qu’il démarre au démarrage avec systemd:**

.. code-block::

   sudo systemctl enable docker.service
   sudo systemctl enable containerd.service

|image1600|



.. |image1595| image:: ../media/image1595.webp
   :width: 400px
.. |image1596| image:: ../media/image1596.webp
   :width: 200px
.. |image1597| image:: ../media/image1597.webp
   :width: 300px
.. |image1598| image:: ../media/image1598.webp
   :width: 300px
.. |image1599| image:: ../media/image1599.webp
   :width: 605px
.. |image1600| image:: ../media/image1600.webp
   :width: 605px
