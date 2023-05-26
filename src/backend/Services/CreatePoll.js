import connection from "../database";
export default function CreatePoll(id, name, info) {
  const query = `
      INSERT INTO poll (id, name, info)
      VALUES
      (
        '${id}',
        '${name}',
        '${info}'
      );
    `;
  connection.query(query, function (error) {
    if (error) {
      console.error("Error executing the query:", error);
    } else {
      console.log(`Create ${name} Poll, id is ${id} and info is ${info}`);
    }
  });
}
