########## Fermion - a super light MVC Framework

### System Requirements

	I used PHP >= 5.3.0.
	Following php extensions need to be enabled in your php.ini file: 
	
		php_pdo_mysql.dll

#### Windows

	Add the following lines to the file(edit with Administrator privileges):	C:\Windows\system32\drivers\etc\hosts
	
	127.0.0.1	fermion.localhost

#### Apache

	Add something like the following to the your Apache httpd.conf file:

	<VirtualHost *:80>
		DocumentRoot "c:/Apache24/htdocs/fermion/public"
		ServerName fermion.localhost
	</VirtualHost>

	Make sure mod_rewrite is enabled and your virtual host(or directory where the project is located) 
	is configured with the AllowOverride option so that the .htaccess rewrite rules can be used:

   AllowOverride All

### Finally
	
	Enter http://fermion.localhost in your Web Browser and you're good to go!
   
## Author

	Aleksandar Jovanovic
		ingelity@gmail.com
		https://github.com/ingelity
		http://rs.linkedin.com/in/ingelity
	
## License

	Available for free use to those who are pure in soul :)