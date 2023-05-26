import connection from "../database";
export default function AddVote(user_id, poll_id, side_id) {
  const query = `
    INSERT INTO vote (user_id, poll_id, side_id)
    VALUES ('${user_id}', '${poll_id}', '${side_id}');
  `;
  connection.query(query, function (error) {
    if (error) {
      console.error("Error executing the query:", error);
    } else {
      console.log(`User ${id} Vote ${side_id} in Poll ${poll_id}`);
    }
  });
}
