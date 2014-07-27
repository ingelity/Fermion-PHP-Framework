Pico MVC PHP Framework
==================
Custom-made MVC PHP Framework with some very useful features.

## Features

	- Dynamic load(update) of content(posts and comments) on page, without the need to refresh the page
	- Flash messages system
	- PDO interface towards database, which makes change of database type possible with only editing 1 line of code
	- Classes Autoloading mechanism
	- Anti-spam protection for your posts/blog
	- Automatic encapsulation of web addresses(entered into comments) into valid html link elements
	- Nice Model-Templates-Controller pattern
	- Separate Router and View classes which enables direct response from server, i.e. in case of an error
	- Custom error pages

### Installation

### Database

	Import the sql dump file inlcuded in this package( database_studios_localhost.sql ), sor some nice starting base.

### System Requirements

	PHP >= 5
	Following php extensions need to be enabled in your php.ini file: 
	
		php_gd2.dll
		php_pdo_mysql.dll

#### Windows

	Add the following lines to the file(edit with Administrator privileges):	C:\Windows\system32\drivers\etc\hosts
	
	127.0.0.1	studios.localhost

#### Apache

	Add something like the following to the your Apache httpd.conf file:

	<VirtualHost *:80>
		DocumentRoot "c:/Apache24/htdocs/studios.localhost/public"
		ServerName studios.localhost
	</VirtualHost>

Make sure mod_rewrite is enabled and your virtual host(or directory where the project is located) 
is configured with the AllowOverride option so that the .htaccess rewrite rules can be used:

   AllowOverride All

### Finally
	
	Enter http://studios.localhost in your Web Browser and you're good to go!

	

##### Explanation of the code

	On the home page there is a list of posts and clicking on some of them opens the page with full display of that post and all the comments on that post.
	
	Regarding spam protection, I used simple Captcha mechanism and additional checking of content which gets written to the database.
Therefore, I used "content_hash" unique index field in "posts" table which makes sure there are no duplicate posts written(comparing "content" field 
which is of type TEXT would be a bad practice). Also, for comments I check for whether a user is trying to post the same comment on the same post.

	For automatic periodical refreshing of the page, I've set a 5 second interval which uses Ajax to check whether number of posts or 
comments on viewed post have changed and if so, load new ones using jQuery.load method. 

   
## Author

	Aleksandar Jovanovic - http://rs.linkedin.com/in/ingelity
	
## License

	Available for free use to those who are pure in soul =)