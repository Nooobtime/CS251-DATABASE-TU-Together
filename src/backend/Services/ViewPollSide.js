import connection from "../database";

const ViewPollSide = (pollId) => {
  const query = `
    SELECT
      *
    FROM
      side
    WHERE
      poll_id = '${pollId}';
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

      console.log("Sides retrieved successfully:", results);
      connection.end();
    });
  });
};

export default ViewPollSide;
