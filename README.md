EmailValidator
==============

Check if the given email address is valid or not using nslookup

We can get a brief idea of if email address is valid or not using regular expressions. Currently with thousands of new TLDs its bit too hard. This tool uses nslookup command to check if a mail exchange server is configured for a domain. This could be the best level of email validation other than actually sending (unsolicited) mail. — Edit

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