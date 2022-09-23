from datetime import time

def amountLinesToFile(nameFile):
    with open(nameFile) as f:
        result = 0
        for line in f:
            result += 1
    return result


fileForRead = open('n_log1.txt', 'r')
fileForOut = open('out1.txt', 'w')
counter = 0
listTimestampOfLines = []

substring1 = 'A00000000002'
substring2 = 'ON_LINE-'

listLinesOfFileLog = fileForRead.readlines()

for line in listLinesOfFileLog:
    if line.find(substring1) < line.find(substring2):
        fileForOut.write(line)
        counter += 1
        listTimestampOfLines.append(line.split('   ')[1].strip())

line_count = amountLinesToFile('out1.txt') + counter
print('Количество строк в файле out1.txt: ' + str(line_count))

for item in listTimestampOfLines:
    print(time(int(item.split(':')[0]), int(item.split(':')[1]), int(item.split(':')[2]), int(item.split(':')[3])))


