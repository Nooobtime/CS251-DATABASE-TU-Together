import { createConnection } from "mysql";
const connection = createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "test",
  connectionLimit: 10,
});
export default connection;
