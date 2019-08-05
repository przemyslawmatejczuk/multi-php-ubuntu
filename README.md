##### Requirements
- stop & remove apache2 
    
    `sudo service apache2 stop && sudo apt-get --purge remove apache2 apache2-utils apache2.2-bin apache2-common && sudo apt-get autoremove`

- stop & remove mysql 

    `sudo service mysql stop && sudo apt-get --purge remove mysql* && sudo apt-get autoremove`

- install ansible + git
```
sudo apt-get install software-properties-common -y
yes '' | sudo apt-add-repository ppa:ansible/ansible -y
sudo apt-get update
sudo apt-get install -y ansible git
```

##### First run
- clone this repository
- create vars files based on vars/*.yml.dist
- edit `main_user` in main.yml
- edit php versions in php.yml
- run `ansible-playbook site.yml`


##### Services
- http://pma.loc - phpmyadmin
- http://php.loc - list of available php versions
- http://mailhog.loc - mailhog


##### Commands
- restart all php services `sudo php-fpm-restart`


##### Sample vhost
- create project dir in /home/[username]/workspace with .nginx.conf file
- edit `server_name`, set `$project_root` to project path
- view file example.conf for example configuration
- restart nginx

