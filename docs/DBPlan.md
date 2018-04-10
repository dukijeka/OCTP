
## Database plan

<br>


user (

	id,
	username,
	passwordHash,
	firstName,
	lastName,
	email,
	dateOfBirth,
	gender

);

language (

	id,
	name
	
);

knows_language (

	userId,
	languageId
	
);

translation (

	id,
	sentenceId,
	languageId,
	userId,
	date,
	translationText

);

rating (

	userId,
	translationId,
	date,
	ratingValue

);

document (

	id,
	postingUserId,
	dateCreated,
	languageId,
	text,

);

sentence (

	id,
	documentId,
	text

);

wanted_translations (

	documentId,
	wantedLanguageId

);

report (

	documentId,
	userId,
	date,
	explanation

);


