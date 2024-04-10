let questionNr = 0;
let goodQuestionNr = 1;
let questions = [];
let formData = [];
let lengthQuestions;
let index = 0;
let expQuestion = 0;
let totalExpQuestion = 0;
let data;
let good = 0;
let wrong = 0;
let returnValueIndex;

function loadQuestions(id) {
  const url = `./getQuestions.php?listId=${id}`;

  fetch(url, {
    method: "GET",
    headers: { "Content-type": "application/json" },
  })
    .then((response) => response.json())
    .then((json) => {
      data = json;
      lengthQuestions = json.length;
      expQuestion = 100 / lengthQuestions;
      setQuestion(data);
    })
    .catch((error) => {
      // Handle error if needed
    });
}

function setQuestion() {
  const questionBlockPlay = $("#questionBlockPlay");
  questionBlockPlay.empty();

  const currentQuestion = data[index];
  const questionLabel = `<label for="name" class="form-label h5 mb-3">${currentQuestion.question}</label>`;
  const answerInput =
    '<input type="text" class="form-control" id="answer" aria-describedby="nameHelp" name="answer">';

  questionBlockPlay.append(questionLabel + "\n" + answerInput);
}

function checkQuestionOut() {
  if (index === lengthQuestions) {
    document.getElementById("displayOne").style.display = "none";
    document.getElementById("displayTwo").style.display = "block";

    totalExpQuestion += expQuestion;

    const progressBar = document.querySelector(".progress-bar");
    progressBar.style.width = totalExpQuestion + "%";

    document.getElementById("good").innerHTML = good;
    document.getElementById("wrong").innerHTML = wrong;

    document.getElementById("goodBox").value = good;
    document.getElementById("wrongBox").value = wrong;
  } else {
    nextQuestion();
  }
}

function checkAnswer(yourAnswer) {
  const currentQuestion = data[index];

  fetch(
    `./checkAnswer.php?questionId=${currentQuestion.id}&answer=${yourAnswer}`,
    {
      method: "GET",
      headers: { "Content-type": "application/json" },
    }
  )
    .then((response) => response.json())
    .then((json) => {
      if (json.hasOwnProperty("error")) {
        // Handle server-side errors
        alert("Error: " + json.error);
        return;
      }

      if (json.result === "correct") {
        alert("Antwoord goed");
        good++;
      } else if (json.result === "incorrect") {
        alert(
          `Antwoord niet goed, juiste antwoord was: ${json.correct_answer}`
        );
        wrong++;
      } else {
        // Handle unexpected responses
        alert("Onverwachte reactie van de server.");
      }

      index++;
      checkQuestionOut();
    })
    .catch((error) => {
      // Handle network errors
      console.error(error);
    });
}

function nextQuestion() {
  totalExpQuestion += expQuestion;

  const progressBar = document.querySelector(".progress-bar");
  progressBar.style.width = totalExpQuestion + "%";

  setQuestion();
}

function setDocumentBegin() {
  $(document).ready(function () {
    const addButton = $("#makeQuestions");
    const questionsField = $("#makeQuestionsField");

    addButton.click(function () {
      questionsField.append(generateQuestionBlock(questionNr, goodQuestionNr));
      questionNr++;
      goodQuestionNr++;
    });

    for (let i = 1; i < 6; i++) {
      questionsField.append(generateQuestionBlock(questionNr, i));
      questionNr++;
      goodQuestionNr++;
    }
  });
}

function setDocument() {
  $(document).ready(function () {
    const questionsField = $("#makeQuestionsField");
    questionsField.empty();

    for (let i = 0; i < questionNr; i++) {
      questionsField.append(generateQuestionBlock(i, i + 1));
    }
  });
}

function generateQuestionBlock(index, goodQuestionIndex) {
  return `
    <div class="col-lg-12 mt-3 mb-3 border rounded hover-background-gray" id="QuestionBlock${index}">
      <div class="m-lg-2">
        <div class="mt-3 mb-3">
          <label for="name" class="form-label">Vraag ${goodQuestionIndex}:</label>
          <input type="text" class="form-control" id="Question${index}" aria-describedby="nameHelp" name="name" required>
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Antwoord:</label>
          <input type="text" class="form-control" id="Answer${index}" aria-describedby="emailHelp" name="email" required>
        </div>
        <button class="btn btn-danger" onclick="deleteQuestionBlock(this.id)">Verwijder</button>
      </div>
    </div>`;
}

function registerQuestion() {
  if (questionNr === 0) {
    setErrorMessage("Vul tenminste 1 vraag in");
    returnValueIndex = 1;
  } else {
    for (let i = 0; i < questionNr; i++) {
      const questionValue = $("#Question" + i)[0].value;
      const answerValue = $("#Answer" + i)[0].value;

      if (questionValue === "" || answerValue === "") {
        setErrorMessage("Niet alles ingevuld");
        returnValueIndex = 1;
        break;
      } else {
        questions.push([questionValue, answerValue]);
      }
    }
  }

  if (returnValueIndex !== 1) {
    const nameListValue = $("#nameList")[0].value;
    const descriptionListValue = $("#descriptionList")[0].value;

    if (nameListValue === "" || descriptionListValue === "") {
      return setErrorMessage("Niet alles ingevuld");
    } else {
      formData.push(nameListValue);
      formData.push(descriptionListValue);

      $.ajax({
        url: "./sendQuestions.php",
        type: "post",
        data: { data: questions, formData: formData },
        success: function (response) {
          window.location.href = "./lists.php";
          goToPage("lists.php");
        },
        error: function (jqXHR, textStatus, errorThrown) {
          window.location.href = "./lists.php";
          return setErrorMessage("Lijst maken niet gelukt, probeer opnieuw");
        },
      });
    }
  }
}

function setErrorMessage(message) {
  setMessageAlertBoxLogin("alertDangerList", "alertDangerListText", message);
}

function deleteQuestionBlock(id) {
  let goodId = "QuestionBlock" + id;

  questionNr--;
  goodQuestionNr--;

  $("#" + goodId).remove();
  setDocument();
}

function setMessageAlertBoxLogin(elementId, textId, message) {
  document.getElementById(elementId).style.display = "block";
  document.getElementById(textId).innerHTML = message;

  setTimeout(setElementHide, 5000, elementId);
}

function setElementHide(elementId) {
  document.getElementById(elementId).style.display = "none";
}

function goToPage(page) {
  window.location.href = page;
}
