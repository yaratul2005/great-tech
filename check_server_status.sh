ssh -i ryunkendo yaratul.com@ssh.us.stackcp.com
5. To transfer files between local and remote server:
   # From local to remote:
   scp -i ryunkendo [local_file_path] yaratul.com@ssh.us.stackcp.com:[remote_path]
   
   # From remote to local:
   scp -i ryunkendo yaratul.com@ssh.us.stackcp.com:[remote_file_path] [local_path]

To exit the SSH session, type 'exit'.

EOF