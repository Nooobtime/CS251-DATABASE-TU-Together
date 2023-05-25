import connection from "../database";
const AddVote = (userId, poll_id, side_id) => {
  const query = `
    INSERT INTO vote (user_id, poll_id, side_id)
    VALUES ('${userId}', '${poll_id}', '${side_id}')
  `;
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

export default AddVote;
