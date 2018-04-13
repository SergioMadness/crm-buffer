CRMBuffer
====

This is proxy for messages to CRM and other systems.

For example, you need to send leads and contacts to CRM Bitrix24, but it can't processes a lot of requests. 

Buffer can help you. It cached requests and send pack every 10(configured value) minutes. 


Requirements
------------
 - PHP 7.1+
 - Queue
 - Database

Dependencies
------------
 - [mesilov/bitrix24-php-sdk](https://github.com/mesilov/bitrix24-php-sdk)
 - [ramsey/uuid](https://github.com/ramsey/uuid)


The MIT License (MIT)
---------------------

Copyright (c) 2018 Sergey Zinchenko, [Professional web](http://web-development.pw)

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