#!/bin/bash
sudo docker run -d -p 80:80 \
	-v `pwd`:/var/www/html \
	--name onetimepad \
    onetimepad
