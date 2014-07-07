EmailValidator
==============

Check if the given email address is valid or not using nslookup

You need the tool ```nslookup``` installed on the machine running this tool.

To install nslookup, run the command

####CentOS/RHEL
```sh
# yum install bind-utils
```
####Ubuntu/Debian
```sh
# sudo apt-get update
# sudo apt-get install dnsutils

```

###Usage

Normal PHP

```php
require_once 'PHP-EmailValidator/emailvalidator.php';
$validator = new EmailValidator();    
print $validator->is_valid('atemon@skdjfg.com')?'True':'False';

```

in CodeIgniter

* copy emailvalidator.php to library folder

```php
$this->load->library('emailvalidator');
$this->emailvalidator->is_valid('atemon@skdjfg.com')
```