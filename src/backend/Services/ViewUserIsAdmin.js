import connection from "../database";

const ViewUserIsAdmin = (userId) => {
  const query = `
    SELECT
      isAdmin
    FROM
      user
    WHERE
      id = '${userId}';
  `;

  connection.connect((err) => {
    if (err) {
      console.error("Error connecting to the database:", err);
      return;
    }

    connection.query(query, (error, results, fields) => {
      if (error) {
        console.error("Error executing the SQL statement:", error);
        return;
      }

      if (results.length === 0) {
        console.log("User not found!");
      } else {
        const isAdmin = results[0].isAdmin;
        console.log("User isAdmin status:", isAdmin);
      }

      connection.end();
    });
  });
};

export default ViewUserIsAdmin;
