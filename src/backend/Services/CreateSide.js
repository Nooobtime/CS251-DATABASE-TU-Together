import connection from "../database";
export default function CreateSide(id, poll_id, name, info) {
  const query = `
        INSERT INTO side (id, poll_id, name, info)
        VALUES
        (
          '${id}',
          '${poll_id}',
          '${name}',
          '${info}'
        );
      `;
  connection.query(query, function (error) {
    if (error) {
      console.error("Error executing the query:", error);
    } else {
      console.log(
        `Create ${name} in ${poll_id} Poll,side id is ${id} and info is ${info}`
      );
    }
  });
}
