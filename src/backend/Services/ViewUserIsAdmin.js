import connection from "../database";
export default function ViewUserIsAdmin(id) {
  return new Promise((resolve, reject) => {
    const query = `SELECT isAdmin FROM user WHERE id = '${id}';`;
    connection.query(query, function (error, results) {
      if (error) {
        console.error("Error executing the query:", error);
        reject(error);
      } else {
        resolve(results);
      }
    });
  });
}
/*
ViewUserIsAdmin(123)
  .then((results) => {
    // Handle the retrieved poll data
    console.log(results);
  })
  .catch((error) => {
    // Handle any errors that occurred during the query
    console.error(error);
  });
*/
