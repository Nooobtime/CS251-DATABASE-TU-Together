import connection from "../database";
const CreatePoll = (id, name, info) => {
  const query = `
    INSERT INTO poll (id, name, info)
    VALUES ('${id}', '${name}', '${info}')
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

export default CreatePoll;
