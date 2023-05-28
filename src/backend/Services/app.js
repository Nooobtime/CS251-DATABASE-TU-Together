import mysql from "mysql";

const pool = mysql.createPool({
  connectionLimit: 10,
  host: "localhost",
  user: "root",
  password: "",
  database: "test",
});

async function viewPollList() {
  try {
    const query = `SELECT * FROM poll`;
    const results = await new Promise((resolve, reject) => {
      pool.query(query, (error, results) => {
        if (error) {
          console.error("Error executing the query:", error);
          reject(error);
        } else {
          resolve(results);
        }
      });
    });

    const formattedResults = results.map((row) => ({ ...row }));

    console.log(formattedResults);
    return formattedResults;
  } catch (error) {
    console.error("Error executing the query:", error);
    throw error;
  }
}

viewPollList()
