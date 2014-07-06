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
```
# sudo apt-get update
# sudo apt-get install dnsutils

```

###Usage
```sh
require_once 'EmailValidator/emailvalidator.php';
$validator = new EmailValidator();    
print $validator->is_valid('vc@skdjfg.com')?'True':'False';

```