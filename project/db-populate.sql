USE ccs_db;

SET
  @student1 = UUID();
SET
  @student2 = UUID();

SET
  @teacher = UUID();

SET
  @chat_room = UUID();

INSERT INTO
  users
VALUES
  (@student1, "student1", "student1@fmi.bg", PASSWORD("student1"), "USER"),
  (@student2, "student2", "student2@fmi.bg", PASSWORD("student2"), "USER"),
  (@teacher, "teacher", "teacher@fmi.bg", PASSWORD("teacher"), "ADMIN");

INSERT INTO
  students
VALUES
  (@student1, "FACULTY1", 1, "Software Degradation", "Mahalata"),
  (@student2, "FACULTY2", 1, "Software Degradation", "Mahalata");

INSERT INTO
  teachers
VALUES
  (@teacher);

INSERT INTO
  chat_rooms(id, name)
VALUES
  (@chat_room, "chatroom");

INSERT INTO
  user_chats
VALUES
  (UUID(), @student1, @chat_room, CURRENT_TIMESTAMP, TRUE);

INSERT INTO
  messages(userId, chatRoomId, content)
VALUES
  (@student1, @chat_room, "Veni Vidi Vici");
