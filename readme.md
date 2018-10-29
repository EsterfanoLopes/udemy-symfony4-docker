Clone the repository \
composer update \
docker-compose build \
docker-compose up -d \

**xDEBUG**

xdebug.remote_enable=on \
xdebug.remote_autostart=on \
xdebug.remote_port=9000 \
xdebug.remote_connect_back=1 \
xdebug.idekey="PHPSTORM" \

Point PHPSTORM cli interpreter to your dockerfile \
Configure Server to your local LAN ip and set xdebug port \
Set the absolute path on the server