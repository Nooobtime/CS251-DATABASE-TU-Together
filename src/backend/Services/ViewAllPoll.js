import connection from "../database";

const viewAllPolls = () => {
  const query = "SELECT * FROM poll";

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

      console.log("Polls:");
      console.log(results);
      connection.end();
    });
  });
};

export default viewAllPolls;
