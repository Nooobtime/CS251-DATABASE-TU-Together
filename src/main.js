import { createApp } from "vue";
import App from "./App.vue";
import router from "./router";
import NavBar from "./components/NavBar.vue";
import Footer from "./components/footer.vue";
import { RouterLink, RouterView } from "vue-router";
import "./style.css";

const app = createApp(App);
app.use(router);
app.component("NavBar", NavBar);
app.component("Footer", Footer);
app.component("RouterLink", RouterLink);
app.component("RouterView", RouterView);
app.mount("#app");


function processVotes(votes, userId, pollId) {
    let userAlreadyVoted = false;
    votes.forEach((vote, index) => {
      if (vote.user_id === userId && vote.poll_id === pollId) {
        console.log("User already voted");
        userAlreadyVoted = true;
      }
    });
    if (!userAlreadyVoted) {
      const newVote = {
        user_id: userId,
        poll_id: pollId,
        side_id: "1",
      };
  
      votes.push(newVote);
      console.log("Vote appended:", newVote);
    }
  }