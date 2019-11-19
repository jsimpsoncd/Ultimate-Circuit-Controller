# poweron
Baytech RPC-3 power control via php and expect

The expect script can be used on its own to control baytech RPC-3 PDUs. 
These are readily available on ebay and have 8 independantly switchable outlets. They are regularly under $50.

Run it like so.

expect /var/www/poweron/power.expect 192.168.0.10 admin password 1 on

To turn outlet 1 on. Of course, you'll need to specify the correct IP, user, and password.

Using the same syntax, you can easily add cron jobs to turn specific outlets on and off at specific times, for example turning on motion sensative outdoor lighting in the evening and off in the morning.

The index.php PHP script is hardcoded for my purposes, but you can easily extend it to make use of all 8 outlets and customize the names.

Todo? Make the dashboard read from a config to determine outlet numbers and names.
