#!/usr/bin/bash

echo "-----------------------------------------------------------------"
echo "-----------Mise à jour vers la version 2.2.7.4-------------------"
echo "-----------------------------------------------------------------"
rm include/footer.php
wget https://raw.githubusercontent.com/mgrafr/monitor/main/include/footer.php
#
rm .version
wget https://raw.githubusercontent.com/mgrafr/monitor/main/.version
echo "-----------------------------------------------------------------------"
echo "-----------Mises à jour vers la version 2.2.7.4 terminées--------------"
echo "-----------------------------------------------------------------------"