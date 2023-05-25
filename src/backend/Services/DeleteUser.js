import connection from "../database";

const DeletePoll = (user_id) => {
  const query = `
      DELETE FROM
      user
      WHERE
      id = '${user_id}';
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

      console.log("Poll deleted successfully!");
      connection.end();
    });
  });
};
export default DeletePoll;
