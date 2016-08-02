# recursive_oldest
Teszt Könyvtár\Fájlok					 (utolsó módosítás)

- recursive_oldest.php 		 (2016-08-02 12:56)

- css\
  - bootstrap-theme.min.css (2016-08-02 12:36)
  - bootstrap-theme.css 		 (2016-08-02 12:16)
  - bootstrap.min.css 			 (2016-08-02 12:15)
  - bootstrap.css 				 (2016-08-02 12:15)
  - sub-css\
    - bootstrap.css 				 (2016-07-25 15:53)

- js\
  - bootstrap.js 				  	 (2016-08-02 12:36)
  - js.cookie.js 					 (2016-07-31 00:01)
  - bootstrap.min.js 			 (2016-07-25 15:53) 
  - npm.js 							 (2016-07-25 15:53) 


1.)
$path = '.';
$extension = 'css';

Kimenet: Legrégebben módosított .css fájl a(z) . könyvtárban és alkönytáraiban: .\css\sub-css\bootstrap.css
------------------------
2.)
$path = '.';
$extension = 'js';

Kimenet: Legrégebben módosított .js fájl a(z) . könyvtárban és alkönytáraiban: .\js\npm.js
------------------------
3.)
$path = '.\css';
$extension = 'css';

Kimenet: Legrégebben módosított .css fájl a(z) .\css könyvtárban és alkönytáraiban: .\sub-css\bootstrap.css
------------------------
4.)
$path = '.\html';
$extension = 'html';

Kimenet: RecursiveDirectoryIterator::__construct(.\html\,.\html\): The system cannot find the file specified. (code: 2)
------------------------
5.)
$path = '.\css';
$extension = 'php';

Kimenet: Nem található php kiterjesztésű fájl a könyvtárban.
