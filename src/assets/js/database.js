import { createConnection } from 'mysql';
var connection = createConnection({
  host     : 'localhost',
  user     : 'me',
  password : 'secret',
  database : 'my_db'
});

connection.connect();

export default connection;

/*In the component where you want to use the database connection, import the connection object at the top of the file:
import db from './db.js';
Use the db.query() method to execute SQL queries against the database:
db.query('SELECT * FROM users', function (error, results, fields) {
  if (error) throw error;
  console.log(results);
});
*/
