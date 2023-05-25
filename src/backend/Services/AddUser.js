import connection from "../database";
const AddUser = (userId, isAdmin) => {
  const query = `INSERT INTO user (id, isAdmin) VALUES ('${userId}', ${isAdmin})`;
  connection.connect((err) => {
    if (err) {
      console.error("Error connecting to the database:", err);
      return;
    }
    connection.query(query, (error) => {
      if (error) {
        console.error("Error executing the SQL statement:", error);
        return;
      }
      console.log("New user inserted successfully!");
      connection.end();
    });
  });
};

export default AddUser;
