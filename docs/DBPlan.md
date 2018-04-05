
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
)

knows_language (

	userId,
	languageId
);

translation (

	id,
	sentenceId,
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
	languageRequestedId,
	text,


);

sentence (

	id,
	documentId,
	text

);



