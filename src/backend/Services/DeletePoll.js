import connection from "../database";
export default function DeletePoll(poll_id) {
  const query = `
    DELETE FROM vote WHERE poll_id = '${poll_id}';
    DELETE FROM side WHERE poll_id = '${poll_id}';
    DELETE FROM poll WHERE id = '${poll_id}';
  `;
  connection.query(query, function (error) {
    if (error) {
      console.error("Error executing the query:", error);
    } else {
      console.log(`delete poll ${poll_id}`);
    }
  });
}
