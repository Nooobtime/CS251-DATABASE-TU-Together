import { createConnection } from 'mysql'
//connection to MySql
var connection = createConnection({
  host: 'sql12.freemysqlhosting.net',
  user: 'sql12615707',
  password: 'qfAAk96pTa',
  database: 'sql12615707'
})
connection.connect()
export default connection

/*In the component where you want to use the database connection, import the connection object at the top of the file:
import db from './db.js';
Use the db.query() method to execute SQL queries against the database:
db.query('SELECT * FROM users', function (error, results, fields) {
  if (error) throw error;
  console.log(results);
});
use
https://www.phpmyadmin.co/
to edit
*/
