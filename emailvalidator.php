<?php
/*

Copyright (c) 2014 Agile Technology Engineers Monastery - ATEMON

Git Hub: https://github.com/atemon
Twitter: https://twitter.com/atemonastery

This file is part of EmailValidator library and distributed under the MIT license (MIT).

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
*/
class EmailValidator{
    
    public function is_valid($email){
        
        if(!$email){
            return false;
        }
        /*
        RFC 3696
        In addition to restrictions on syntax, there is a length limit on email addresses. 
        That limit is a maximum of 64 characters (octets) in the "local part" (before the "@") 
        and a maximum of 255 characters (octets) in the domain part (after the "@") for a total 
        length of 320 characters. However, there is a restriction in RFC 2821 on the length of 
        an address in MAIL and RCPT commands of 254 characters. Since addresses that do not fit 
        in those fields are not normally useful, the upper limit on address lengths should 
        normally be considered to be 254.
        */
        if(strlen($email) > 254 ){
            return false;
        }
        $parts = explode('@',$email);
        
        if(count($parts) != 2){
            return false;    // Something wrong, you got some mail address like some@email@domain.com
        }
        if(strlen($parts[0]) > 64 ){
            return false;
        }
        if(strlen($parts[1]) > 255 ){
            return false;
        }

        if(!preg_match("/[a-z0-9\!\#\$\%\&\'\*\+\/\=\?\^\_\`\{\|\}\~\-]+(?:\.[a-z0-9\!\#\$\%\&\'\*\+\/\=\?\^\_\`\{\|\}\~\-]+)*/",$parts[0])){
            return false;   // RFC allows these characters in email, though most MSPs don't 
        }

        return $this->valid_mx($parts[1]);   // A valid mail exchange server is configured!
    }

    public function nslookup_installed() {
        return (empty(shell_exec("which nslookup")) ? false : true);
    }

    public function valid_mx($domain){
        if($this->nslookup_installed()){
            $rv = shell_exec("nslookup -query=mx $domain");
            if(preg_match('/mail exchanger/', $rv)){
                return true;
            }
            return false;   
        }
        else{
            return false;
        }
    }
}
