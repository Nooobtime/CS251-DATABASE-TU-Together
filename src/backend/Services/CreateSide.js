import connection from "../database";

const CreateSide = (id, poll_id, name, info) => {
  const query = `
    INSERT INTO side (id, poll_id, name, info)
    VALUES ('${id}', '${poll_id}', '${name}', '${info}');
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

      console.log("New side inserted successfully!");
      connection.end();
    });
  });
};

export default CreateSide;
