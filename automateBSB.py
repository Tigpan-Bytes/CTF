mins = 0.1

import tkinter as tk
import random
from time import sleep
from math import floor
from tkinter import filedialog
from os import listdir, unlink, rename
from os.path import isfile, join
from shutil import copy

root = tk.Tk()

main_path = filedialog.askdirectory()


class Timer:
    def __init__(self, parent):
        self.seconds = int(mins * 60)
        self.label = tk.Label(parent, text=str(mins) + ":00", font="Arial 256")
        self.label.pack(expand=True, fill='both')
        self.label.after(1000, self.refresh_label)
        self.label.bind("<Button-1>", self.click)

    def click(self, event):
        self.seconds = int(mins * 60)
        self.label.configure(text=str(mins) + ":00", font="Arial 256")

    def refresh_label(self):
        if self.seconds <= 0:
            bot_path = './bots'

            for file in listdir(bot_path):
                file_loc = join(bot_path, file)
                if isfile(file_loc):
                    unlink(file_loc)

            for dir in listdir(main_path):
                dir_loc = join(main_path, dir)
                if not isfile(dir_loc):
                    for file in listdir(dir_loc):
                        file_loc = join(dir_loc, file)
                        if isfile(file_loc):
                            copy(file_loc, bot_path)
                            rename(join(bot_path, file), join(bot_path, file[:-3] + '                ' + str(
                                random.randint(0, 999999)) + '.py'))
            text = "Next Round!"

            self.label.configure(text=text, font="Arial 172")
        else:
            self.seconds -= 1

            if self.seconds % 60 < 10:
                text = str(floor(self.seconds / 60)) + ":0" + str(self.seconds % 60)
            else:
                text = str(floor(self.seconds / 60)) + ":" + str(self.seconds % 60)

            self.label.configure(text=text, font="Arial 256")

        self.label.after(1000, self.refresh_label)


timer = Timer(root)
root.mainloop()





