describe('angularjs homepage todo list', function () {
  var EC = protractor.ExpectedConditions
  var user = '6409650089'
  var pass = '1129701288545'

  beforeEach(async () => {
    //login every time when start each test
    await browser.get('http://localhost:8000/login')
    var eleUsernName = element(by.id('username'))
    var elePassWord = element(by.id('password'))
    var eleLoginBtn = element(by.id('login'))
    await browser.wait(EC.visibilityOf(eleUsernName), 10000)
    await browser.wait(EC.visibilityOf(elePassWord), 10000)
    await browser.wait(EC.visibilityOf(eleLoginBtn), 10000)
    await eleUsernName.sendKeys(user)
    await elePassWord.sendKeys(pass)
    await eleLoginBtn.click()
  })

  afterEach(async () => {
    //logout every time when end each test
    await browser.get('http://localhost:8000/')
    var eleLogout = element(by.id('logout'))
    await browser.wait(EC.visibilityOf(eleLogout), 10000)
    await eleLogout.click()
  })

  it('test tu api for login', async () => {
    //expect have navbar
  })

  it('ex', async () => {
    /*
    element(by.model('')).sendKeys('')
    element(by.css('')).click()
    expect(xxxx.getText()).toEqual('')
    var completedAmount = element.all(by.css('.done-true'))
    expect(completedAmount.count()).toEqual(2)
    */
  })
})
