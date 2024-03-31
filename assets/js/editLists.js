let returnValueEdit = 0;
let questionsEdit = [];
let lengthQuestionsEdit = 0;

function loadQuestionsEditLength(id) {
  $.ajax({
    url: "./getQuestions.php",
    type: "post",
    data: { id: id },
    success: function (response) {
      data = JSON.parse(response);
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    },
  });

  console.log(lengthQuestionsEdit + 1);
}

function registerUpdate() {
  let questionsEdit = [];
  let formData = {};
  let returnValueEdit = 0;

  for (let i = 0; i < lengthQuestionsEdit; i++) {
    if (
      $("#Question" + i)[0].value === "" ||
      $("#Answer" + i)[0].value === ""
    ) {
      setMessageAlertBoxLogin(
        "alertDangerList",
        "alertDangerListText",
        "Niet alle velden zijn ingevuld"
      );
      returnValueEdit = 1;
      break;
    } else {
      questionsEdit.push({
        question: $("#Question" + i)[0].value,
        answer: $("#Answer" + i)[0].value,
        questionId: $("#questionId" + i)[0].value,
      });
    }
  }

  if (returnValueEdit !== 1) {
    if (
      $("#nameList")[0].value === "" ||
      $("#descriptionList")[0].value === ""
    ) {
      return setMessageAlertBoxLogin(
        "alertDangerList",
        "alertDangerListText",
        "Niet alle velden zijn ingevuld"
      );
    } else {
      formData = {
        listId: $("#listId")[0].value,
        name: $("#nameList")[0].value,
        description: $("#descriptionList")[0].value,
      };

      $.ajax({
        url: "./editListsQuestions.php",
        type: "post",
        data: {
          data: JSON.stringify(questionsEdit),
          formData: JSON.stringify(formData),
        },
        success: function (response) {
          window.location.href = "./lists.php";
          setMessageAlertBoxLogin(
            "alertDangerList",
            "alertDangerListText",
            "Lijst succesvol bewerkt"
          );
        },
        error: function (jqXHR, textStatus, errorThrown) {
          setMessageAlertBoxLogin(
            "alertDangerList",
            "alertDangerListText",
            "Lijst bewerken niet gelukt. Probeer opnieuw."
          );
        },
      });
    }
  }
}

function setFieldsEdit(id) {
  $.ajax({
    url: "./getSettingsList.php",
    type: "post",
    data: { id: id },
    success: function (response) {
      const obj = JSON.parse(response);

      console.log(obj);

      lengthQuestionsEdit = obj.length;

      $("#makeQuestionsField").empty();

      for (let i = 0; i < obj.length; i++) {
        let j = i + 1;
        $("#makeQuestionsField").append(
          '<div class="col-lg-12 mt-3 mb-3 border rounded hover-background-gray" id="QuestionBlock' +
            i +
            '">\n' +
            '    <div class="m-lg-2">\n' +
            '        <div class="mt-3 mb-3">\n' +
            '            <label for="name" class="form-label">Vraag  ' +
            j +
            ":</label>\n" +
            '            <input type="text" class="form-control" id="Question' +
            i +
            '" aria-describedby="nameHelp" name="name"" value=\'' +
            obj[i]["question"] +
            "' required>\n" +
            '            <input type="hidden" name="questionId" id="questionId' +
            i +
            '" value="' +
            obj[i]["id"] +
            '">\n' +
            "        </div>\n" +
            '        <div class="mb-3">\n' +
            '            <label for="email" class="form-label">Antwoord  ' +
            j +
            ":</label>\n" +
            '            <input type="text" class="form-control" id="Answer' +
            i +
            '" aria-describedby="emailHelp" name="email" value=\'' +
            obj[i]["good_answer"] +
            "' required>\n" +
            "        </div>\n" +
            '        <button class="btn btn-danger" onclick="removeQuestionBlock(' +
            i +
            ')">Verwijder</button>' +
            "    </div>\n" +
            "    </div>\n" +
            "</div>"
        );
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(textStatus, errorThrown);
    },
  });
}

function addQuestionBlock() {
  const index = lengthQuestionsEdit;
  const j = index + 1;

  const newQuestionBlock = `
    <div class="col-lg-12 mt-3 mb-3 border rounded hover-background-gray" id="QuestionBlock${index}">
      <div class="m-lg-2">
        <div class="mt-3 mb-3">
          <label for="name" class="form-label">Vraag ${j}:</label>
          <input type="text" class="form-control" id="Question${index}" aria-describedby="nameHelp" name="name" required>
          <input type="hidden" name="questionId" id="questionId${index}" value="">
        </div>
        <div class="mb-3">
          <label for="email" class="form-label">Antwoord ${j}:</label>
          <input type="text" class="form-control" id="Answer${index}" aria-describedby="emailHelp" name="email" required>
        </div>
        <button class="btn btn-danger" onclick="removeQuestionBlock(${index})">Verwijder</button>
      </div>
    </div>`;

  $("#makeQuestionsField").append(newQuestionBlock);
  lengthQuestionsEdit++;
}

function removeQuestionBlock(index) {
  if (lengthQuestionsEdit > 1) {
    $("#QuestionBlock" + index).remove();

    for (let i = index + 1; i < lengthQuestionsEdit; i++) {
      const j = i - 1;
      $(`#Question${i}`)
        .val($(`#Question${i}`).val())
        .attr({ id: `Question${j}`, name: `name${j}` });
      $(`#Answer${i}`)
        .val($(`#Answer${i}`).val())
        .attr({ id: `Answer${j}`, name: `email${j}` });
      $(`#questionId${i}`).attr({
        id: `questionId${j}`,
        name: `questionId${j}`,
      });
      $(`#QuestionBlock${i}`).attr("id", `QuestionBlock${j}`);
      $(`#QuestionBlock${j} label`).text(`Vraag ${j + 1}:`);
    }

    lengthQuestionsEdit--;
  }
}
