import { createConnection } from "mysql";
export default connection = createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "test",
  connectionLimit: 10,
});
