#!/bin/bash
# auteur = papoo
# 23/09/2018
# https://pon.fr/bash-pour-les-adeptes-des-versions-beta-de-domoticz-et-les-autres
# https://easydomoticz.com/forum/viewtopic.php?f=17&t=7179
# script légèrement modifié le 10/08/2021 par m. gravier, http://domo-site.fr:
#   - répertoires user et domoticz dans des variables
#	- utilisation de systemd

repuser=/home/michel/
repdz=/home/michel/domoticz/

fct_stop ()
{    
    sudo systemctl stop domoticz
}
fct_start ()
{
    sudo systemctl start domoticz
}
fct_update ()
{
echo
echo
echo "backup : 1"
echo
echo "Update Beta : 2"
echo
echo "Update Release : 3"
echo
echo "Restore (/!\efface le repertoire domoticz/!\) : 4"
echo
echo "Suppression archive : 5"
echo
echo "Q : Quitter le Script"
echo
echo "Choix : "
echo
read optionmenu
    case $optionmenu in
    1)
        echo
        echo "lancement Backup"
        echo
        ### make backup
        fct_stop
        sudo /bin/tar -zcvf domoticz_backup.tar.gz $repdz >&/dev/null

        ### copy backup to backup folder
        #sudo /bin/cp /tmp/domoticz_total_$CONCAT.tar.gz $DESTINATION > /dev/null

        ### Remove temp backup file
        #sudo /bin/rm /tmp/domoticz_total_$CONCAT.tar.gz > /dev/null
        #sudo /bin/rm -Rf /tmp/*.tar.gz > /dev/null
        sleep 5
        echo "backup termine relance service domoticz"
        fct_start
        fct_update;;
    2)
        echo
        echo "lancement updatebeta"
        echo
        cd $repdz
        sudo /bin/bash ${repdz}updatebeta >&/dev/null;
        sleep 5;;
    3)
        echo
        echo "lancement updaterelease"
        echo
        cd $repdz
        sudo /bin/bash ${repdz}updaterelease >&/dev/null;
        sleep 5;;
    4)
        echo
        echo "lancement restoration"
        fct_stop
        echo
        if [ -f "${repuser}domoticz_backup.tar.gz" ]
        then
            echo "le fichier domoticz_backup.tar.gz existe"
            echo "Suppression du repertoire domoticz et de son contenu"
            #sudo rm -rf domoticz
            cd
            sudo /bin/tar -xzvf domoticz_backup.tar.gz>&/dev/null;
            sudo /bin/cp -r ${repuser}$repdz $repuser;
            sudo chown -Rf pi $repdz
            sudo rm -rf ${repuser}home/;
        else
            echo "attention pas de fichier archive"
            echo "Executer option 1"
        fct_update            
        fi
        fct_start
        sleep 5;;

    5)
        echo
        echo "Suppression archives"
        echo 
        sudo /bin/rm -Rf domoticz_backup.tar.gz > /dev/null
        sleep 5
        fct_update;;
    Q)
        fct_start
        exit;;
    q)
        fct_start
        exit;;
    *)
        echo
        echo "erreur de frappe"
        echo
        fct_update;;
        esac
}
    clear
    fct_update