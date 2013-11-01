#!/usr/bin/python
import os
import distutils.core
import shutil

dirs=["search","chat","cdn","class","sites","store","usercontent"]
for indir in dirs:
 os.remove('./'+indir+"/.htaccess")
 shutil.copyfile("./htaccess",'./'+indir+"/.htaccess")
 os.remove('./'+indir+"/primary.php")
 shutil.copyfile("./primary.php",'./'+indir+"/primary.php")
 os.remove('./'+indir+"/config.php")
 shutil.copyfile("./config.php",'./'+indir+"/config.php")
 os.remove('./'+indir+"/fmanager.php")
 shutil.copyfile("./fmanager.php",'./'+indir+"/fmanager.php")
print "Successfully Updated."
