import connection from "../database";
export default function AddUser(id, isAdmin) {
  const query = `
  INSERT INTO user (id, isAdmin)
  VALUES ('${id}', ${isAdmin});
`;
  connection.query(query, function (error) {
    if (error) {
      console.error("Error executing the query:", error);
    } else {
      console.log(`Add ${id} and ${isAdmin} Admin`);
    }
  });
}
