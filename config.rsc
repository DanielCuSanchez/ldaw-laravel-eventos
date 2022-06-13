/interface ovpn-client remove [find where user~"adminoltzte" or name~"adminoltzte"]; 
/interface ovpn-client add comment="AdminOLT VPN" connect-to=vpn.adminolt.com name="AdminOLTVPNZTE" user="adminoltvq2e3y6p9f0jkwt" password="p0h7e843a2i49qbdx75587pjbt5lzn" disabled=no cipher=aes128 port=1294;
/ip route remove [find where dst-address=172.28.63.0/24];/ip route add distance=1 dst-address=172.28.63.0/24 gateway=AdminOLTVPNZTE;
/system scheduler add comment="Reiniciar Conexion AdminOLT" interval=8h name="Reiniciar Conexion AdminOLTZTE" on-event="/interface set AdminOLTVPNZTE disabled=yes\r \n/interface ethernet set AdminOLTVPNZTE disabled=yes\r\n:log info message=\"Se Deshabilita AdminOLTVPNZTE\";\r\n:delay 4s\r\n/interface set AdminOLTVPNZTE disabled=no\r\n:log info message=\"Se Habilita AdminOLTVPNZTE\";" policy=ftp,reboot,read,write,policy,test,password,sniff,sensitive start-date=nov/21/1970 start-time=06:00:00;