# Squid3-beEF
Proof of Concept - Hijack [Squid](http://www.squid-cache.org/) proxy traffic and inject [BeEF](http://beefproject.com/) payload into it.

# Requirement
- PHP 5.3
- Apache
- mod_php
- [Squid3](http://www.squid-cache.org/)
- [BeEF](http://beefproject.com/)

# Installation
1. Copy rewrite.php and payload.js to apache document root 
2. Make rewrite.php executable by using following command
    - chmod +x <document root>/rewrite.php
3. Edit /etc/squid3/squid.conf and add following line
    - url_rewrite_program <document root>/rewrite.php
4. Change #\__BEEFURL__# inside payload.js to BeEF Hook URL
5. Create empty folder and allow writable by all user
    - mkdir -p <document root>/payload
    - chmod 0777 <document root>/payload

Be sure to restart squid3 (sudo service squid3 restart) to refresh the changes.