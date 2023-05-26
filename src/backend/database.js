import { createConnection } from "mysql";
const database = createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "test",
  connectionLimit: 10,
});
export default database;
