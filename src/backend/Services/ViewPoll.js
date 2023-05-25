import connection from "../database";

const ViewPoll = (pollId) => {
  const query = `
    SELECT
      *
    FROM
      poll
    WHERE
      id = '${pollId}';
  `;

  connection.connect((err) => {
    if (err) {
      console.error("Error connecting to the database:", err);
      return;
    }

    connection.query(query, (error, results) => {
      if (error) {
        console.error("Error executing the SQL statement:", error);
        return;
      }

      console.log("Poll retrieved successfully:", results);
      connection.end();
    });
  });
};
export default ViewPoll;
