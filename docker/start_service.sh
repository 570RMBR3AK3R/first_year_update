#!/bin/bash

# Start MySQL service
service mysql start

# Start Apache service
service apache2 start

mysql -e "CREATE USER 'noob'@'localhost' IDENTIFIED BY 'noob';"

mysql -e "GRANT ALL PRIVILEGES ON *.* TO 'noob'@'localhost'; FLUSH PRIVILEGES;"



# Keep the script running to prevent the container from exiting
tail -f /dev/null
