import connection from "../database";
export default function DeletePoll(id) {
  const query = `
      DELETE FROM user WHERE id = '${id}';
    `;
  connection.query(query, function (error) {
    if (error) {
      console.error("Error executing the query:", error);
    } else {
      console.log(`delete user ${id}`);
    }
  });
}
