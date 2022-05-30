SET
  @student = UUID();

SET
  @teacher = UUID();

SET
  @chat_room = UUID();

INSERT INTO
  users
VALUES
  (
    @student,
    "student",
    PASSWORD("student"),
    1,
    "Software Degradation",
    "Mahalata",
    "USER"
  ),
  (
    @teacher,
    "teacher",
    PASSWORD("teacher"),
    null,
    null,
    null,
    "ADMIN"
  );

INSERT INTO
  chat_rooms(id, name)
VALUES
  (@chat_room, "chatroom");

INSERT INTO
  user_chats
VALUES
  (UUID(), @student, @chat_room, TRUE);

INSERT INTO
  messages(userId, chatRoomId, content)
VALUES
  (@student, @chat_room, "Veni Vidi Vici");

