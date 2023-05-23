import { browser, element, by, ExpectedConditions } from "protractor";
import { describe } from("jasmine");
describe("angularjs homepage todo list", function () {
  // Define variables
  var EC = protractor.ExpectedConditions;
  var user = "6409650089";
  var pass = "1129701288545";

  beforeEach(async ()=> {
    // Login before each test
    await browser.get("http://localhost:8000/login");
    var eleUserName = element(by.id("username"));
    var elePassword = element(by.id("password"));
    var eleLoginBtn = element(by.id("login"));

    await browser.wait(EC.visibilityOf(eleUserName), 10000);
    await browser.wait(EC.visibilityOf(elePassword), 10000);
    await browser.wait(EC.visibilityOf(eleLoginBtn), 10000);

    await eleUserName.sendKeys(user);
    await elePassword.sendKeys(pass);
    await eleLoginBtn.click();
  });

  afterEach(async ()=> {
    // Logout after each test
    await browser.get("http://localhost:8000/");
    var eleLogout = element(by.id("logout"));

    await browser.wait(EC.visibilityOf(eleLogout), 10000);
    await eleLogout.click();
  });

  it("test tu api for login and logout", async function() {
    // Test case for login and logout
    /*
    var eleLogout = element(by.id('logout'))
    await browser.wait(EC.visibilityOf(eleLogout), 10000)
    await eleLogout.click()
    */
    /*expect have navbar.then()={
      expect if its login page
    }*/
  });

  it("Should be a new poll in the database if created.", async function() {
    // Test case for creating a new poll
    /*
    click on poll page
    click on create button
    fill the data
    */
  });

  it("It should be new data to the poll if the poll is revised.", async function() {
    // Test case for revising a poll
    /*

    */
  });
});
