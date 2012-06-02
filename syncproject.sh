#!/bin/sh

#if (( $1 -eq "update" ))
#then
	#echo "update"
#else
	#echo "delete"
#fi
dirName=$(pwd)
echo '112358132134' | sudo -S rm -r /var/www/${dirName##/*/}
echo '112358132134' | sudo -S cp -ru ../${dirName##/*/} /var/www/
echo '112358132134' | sudo -S chmod a+xr /var/www/${dirName##/*/}
