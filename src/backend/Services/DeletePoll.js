import connection from "../database";

const deletePoll = (poll_id) => {
  const query = `
    DELETE FROM vote
    WHERE poll_id = '${poll_id}';

    DELETE FROM side
    WHERE poll_id = '${poll_id}';

    DELETE FROM poll
    WHERE id = '${poll_id}';
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
export default deletePoll;