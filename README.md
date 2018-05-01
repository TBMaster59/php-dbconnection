# php-dbconnection
Une classe php pour faciliter et optimiser la connexion à une base de données MySQL.

Vous n'arrivez jamais à faire votre connexion à votre base de données? Alors cette classe est faite pour toi. Pour utiliser cette classe, vous devez commencer par initialiser votre connexion :

$database = new Database('db_name', 3306, 'db_user', 'db_password', 'db_host');

Ensuite pour executer votre requette MySQL plus qu'a taper:

$requette = $database->prepare('SELECT * FROM table WHERE field=?', array('valeur1'), true);

La première valeur représente votre requette SQL, la deuxième les valeurs, de votre requette, et la dernière valeur, si elle est sur "false" ne donneras aucune valeur en retour, mais si elle est sur "true" donneras des valeurs en retour, allez voir le code source pour plus d'explication plus détaillé :)

Twitter: https://twitter.com/tb_master59
